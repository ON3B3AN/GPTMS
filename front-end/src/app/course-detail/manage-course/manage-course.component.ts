import { Component, OnInit, AfterViewInit, ElementRef } from '@angular/core';
import {Course} from "../../course";
import {CourseService} from "../../course.service";
import {ActivatedRoute} from "@angular/router";
import * as L from 'leaflet';
import 'leaflet-draw';
import { MatTableDataSource } from '@angular/material/table';
import { FormArray, FormGroup, FormBuilder } from '@angular/forms';

@Component({
  selector: 'app-manage-course',
  templateUrl: './manage-course.component.html',
  styleUrls: ['./manage-course.component.sass']
})
export class ManageCourseComponent implements OnInit, AfterViewInit {
  id: number;
  course: Course;
  courseForm: FormGroup;
  private map;
  private courseMap;
  teeNames: string[];
  submission = [];


  constructor(private courseService: CourseService, private route: ActivatedRoute,
              private fb: FormBuilder, private elementRef: ElementRef) {
    this.courseForm = this.fb.group({
      holes: this.fb.array([])
    });
  }

  ngOnInit(): void {
    this.id = parseInt(this.route.parent.snapshot.paramMap.get('id'));
    this.courseService.getCourse(this.id)
      .subscribe(data => {
        this.course = data;
        this.course.holes.map((item, index) => {
          item.perimeter = (item.perimeter === null) ? '' : JSON.parse(item.perimeter);
          item.tees.map(x => delete x.tee_id);
          this.addItem(item);
        });
        this.teeNames = this.course.holes[0].tees.map(a => a.tee_name);
        console.log(this.course);
        this.updateMap();
        if (this.course.holes.length < 2) {
          this.geocodeAddress(this.course.address).then(json => {
            this.map.setView([json[0].lat, json[0].lon], 14);
          });
        } else {
          this.map.fitBounds(this.courseMap.getBounds());
        }
      });
  }

  ngAfterViewInit(): void {
    this.initMap();
    const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    tiles.addTo(this.map);
  }

  private initMap(): void {
    this.map = L.map('cMap', {
      center: [0, 0],
      zoom: 2,
      scrollWheelZoom: false
    });
    this.courseMap = new L.FeatureGroup();
    this.map.addLayer(this.courseMap);
    var drawControl = new L.Control.Draw({
      draw: {
        polyline: false,
        rectangle: false,
        circle: false,
        marker: false,
        circlemarker: false
      },
      edit: {
        featureGroup: this.courseMap
      }
    });

    this.map.addControl(drawControl);

    this.map.on('draw:created', (e) => {
      var type = e.layerType,
        layer = e.layer;
      var coords = layer.toGeoJSON();
      var tempMarker = this.courseMap.addLayer(layer);
      var opt = '';
      for (let [i, hole] of this.courseForm.value.holes.entries()) {
        if (hole.perimeter === '')
          opt += '<option value="' + i + '">' + hole.hole_number + '</option>';
      }
      const _this = this;
      var popupContent = '<form id="add-geo"><div class="form-group">' +
        '<label class="control-label col-sm-5"><strong>Hole: </strong></label>' +
        '<select id="hole" name="geoHole" class="form-control">' + opt + '</select>' +
        '</div>'+
        '<input style="display: none;" type="text" name="geoCoords" value="' + coords + '" />' +
        '<div class="form-group">' +
        '<div style="text-align:center;" class="col-xs-4 col-xs-offset-2"><button type="button" class="btn">Cancel</button></div>' +
        '<div style="text-align:center;" class="col-xs-4"><button type="submit" class="btn btn-primary trigger-submit">Add</button></div>' +
        '</div></form>';
      tempMarker.bindPopup(popupContent,{
        keepInView: true,
        closeButton: false
      }).on('popupopen', () => {
        _this.elementRef.nativeElement.querySelector("#add-geo").addEventListener("submit", function _listener(e) {
          e.preventDefault();
          e.currentTarget.removeEventListener(e.type, _listener);
          const val = e.target.elements;
          _this.addGeo(val.geoHole.value, coords);
          tempMarker.closePopup().unbindPopup();
          _this.map.removeLayer(layer);
        }, {once: true});
      }).openPopup();
      // Do whatever else you need to. (save to db; add to map etc)
      //this.courseMap.addLayer(layer);
    });

    this.map.on('draw:edited', (e) => {
      var layers = e.layers;
      layers.eachLayer((layer) => {
        //do whatever you want; most likely save back to db
        const i = this.course.holes.findIndex(h => h.hole_number === layer.options.id);
        this.courseForm.get(`holes.${layer.options.id}.perimeter`).setValue(
          layer.toGeoJSON()
        );
        console.log('Hole at index ' + layer.options.id + ' geo updated');
      });
    });

    this.map.on('draw:deleted', (e) => {
      var layers = e.layers;
      layers.eachLayer((layer) => {
        //do whatever you want; most likely save back to db
        if (layer.options.id !== false) {
          const i = this.course.holes.findIndex(h => h.hole_number === layer.options.id);
          this.courseForm.get(`holes.${layer.options.id}.perimeter`).setValue('');
          console.log('Hole at index ' + layer.options.id + ' geo removed');
        }
      });
    });
  }

  addGeo(i, coords): void {
    //const points = coords[0].map(point => [point.lat, point.lng]);
    i = parseInt(i);
    const hole = this.courseForm.value.holes[i].hole_number;
    this.courseForm.get(`holes.${i}.perimeter`).setValue(coords);
    var layer = L.geoJSON(coords).getLayers()[0].setStyle({
      id: i,
      weight: 1,
      fillOpacity: 0.7,
      color: 'red',
      dashArray: '3'
    }).bindTooltip('Hole ' + hole);
    this.courseMap.addLayer(layer);
  }

  updateMap(): void {
    this.courseMap.clearLayers();
    for (let [i, hole] of this.courseForm.value.holes.entries()) {
      try {
        var layer = L.geoJSON(hole.perimeter).getLayers()[0].setStyle({
          id: i,
          weight: 1,
          fillOpacity: 0.7,
          color: 'red',
          dashArray: '3'
        }).bindTooltip('Hole ' + hole.hole_number);
        this.courseMap.addLayer(layer);
      } catch (e) {
        console.log(hole.hole_number);
      }
    }
  }

  addItem(item: any): void {
    const tees = [];
    item.tees.map(x => {
      tees.push(this.fb.group({
        tee_name: [''],
        distance_to_pin: ['']
      }));
    });
    const geos = JSON.stringify(item.perimeter);
    delete item.hole_id;
    delete item.avg_pop;
    const formItem = this.fb.group({
      hole_number: [],
      mens_par: [],
      womens_par: [],
      mens_handicap: [],
      womens_handicap: [],
      tees: this.fb.array([...tees]),
      perimeter: [geos]
    });
    formItem.setValue(item);
    (this.courseForm.get('holes') as FormArray).push(formItem);
  }

  addHole(): void {
    const item = {
      hole_number: this.courseForm.get('holes')['controls'].length + 1,
      mens_par: null,
      womens_par: null,
      mens_handicap: null,
      womens_handicap: null,
      tees: [...this.teeNames.map(x => ({ tee_name: x, distance_to_pin: null }))],
      perimeter: ''
    };
    this.addItem(item);
    this.updateMap();
  }

  addTee(): void {
    for (let hole of this.courseForm.get('holes')['controls']) {
      (hole.get("tees") as FormArray).push(
        this.fb.group({
          tee_name: [''],
          distance_to_pin: ['']
        })
      );
    }
    this.teeNames.push('');
  }

  updateTee(t: number, event): void {
    for (let hole of this.courseForm.get('holes')['controls']) {
      hole.get(`tees.${t}.name`)
        .setValue(event.target.value, {emitEvent:false});
    }
    this.teeNames[t] = event.target.value;
  }

  removeTee(t: number): void {
    for (let hole of this.courseForm.get('holes')['controls']) {
      (hole.get("tees") as FormArray).removeAt(t);
    }
    this.teeNames.splice(t, 1);
  }
  removeHole(h: number): void {
    (this.courseForm.get("holes") as FormArray).removeAt(h);
    this.updateMap();
  }

  updateCourse(): void {
    const holes = JSON.parse(JSON.stringify(this.courseForm.value.holes));
    const newHoles = {};
    for (const [i, hole] of holes.entries()) {
      const tees = {};
      for (const [t, tee] of hole.tees.entries()) {
        tees['tee' + (t + 1)] = tee;
      }
      hole.tees = tees;
      newHoles['hole' + (i + 1)] = hole;
    }
    this.courseService.updateHoles(this.course.course_id, newHoles).subscribe();
  }

  private geocodeAddress(address: string): Promise<any> {
    const json = fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURI(address)).then(function(response) {
      return response.json();
    });
    return json;
  }
}
