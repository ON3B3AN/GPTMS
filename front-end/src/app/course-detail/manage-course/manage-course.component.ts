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
  course: Course = new Course;
  courseForm: FormGroup;
  private map;
  private courseMap;
  holes = [
    {
      "hole_number": 1,
      "par_men": 5,
      "par_ladies": 5,
      "handicap_men": 11,
      "handicap_ladies": 11,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.197381, 42.672343], [-83.196931, 42.672351], [-83.196569, 42.672305], [-83.198961, 42.668155], [-83.199401, 42.668337], [-83.199412, 42.668921], [-83.197381, 42.672343]
          ]]
        }
      }
    },{
      "hole_number": 2,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 9,
      "handicap_ladies": 9,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.199672, 42.668436], [-83.19994, 42.668423], [-83.200122, 42.668279], [-83.200605, 42.667214], [-83.20083, 42.665703], [-83.20053, 42.664125], [-83.200229, 42.664054], [-83.19995, 42.664141], [-83.199807, 42.667432], [-83.199672, 42.668436]
          ]]
        }
      }
    },{
      "hole_number": 3,
      "par_men": 3,
      "par_ladies": 5,
      "handicap_men": 17,
      "handicap_ladies": 15,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.199604, 42.663978], [-83.200302, 42.663994], [-83.201589, 42.664522], [-83.201872, 42.664466], [-83.202029, 42.66427], [-83.201943, 42.664025], [-83.200462, 42.663615], [-83.199465, 42.663726], [-83.199604, 42.663978]
          ]]
        }
      }
    },{
      "hole_number": 4,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 13,
      "handicap_ladies": 13,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.202651, 42.664262], [-83.202837, 42.664001], [-83.202735, 42.663855], [-83.202501, 42.663812], [-83.202254, 42.66401], [-83.200986, 42.665558], [-83.200685, 42.666734], [-83.201093, 42.666931], [-83.201415, 42.666931], [-83.201629, 42.666726], [-83.201747, 42.665969], [-83.202123, 42.665001], [-83.202651, 42.664262]
          ]]
        }
      }
    },{
      "hole_number": 5,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 1,
      "handicap_ladies": 5,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.201787, 42.666841], [-83.201727, 42.666691], [-83.201839, 42.666509], [-83.204737, 42.666202], [-83.206454, 42.666888], [-83.206476, 42.667338], [-83.205929, 42.66733], [-83.204791, 42.666896], [-83.201787, 42.666841]
          ]]
        }
      }
    },{
      "hole_number": 6,
      "par_men": 5,
      "par_ladies": 5,
      "handicap_men": 3,
      "handicap_ladies": 1,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.206087, 42.668591], [-83.205959, 42.668292], [-83.202171, 42.668079], [-83.200572, 42.66841], [-83.199519, 42.669057], [-83.199304, 42.669483], [-83.199819, 42.669656], [-83.200635, 42.669183], [-83.202534, 42.668765], [-83.206087, 42.668591]
          ]]
        }
      }
    },{
      "hole_number": 7,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 7,
      "handicap_ladies": 7,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.199275, 42.669665], [-83.199109, 42.670048], [-83.202435, 42.670348], [-83.20325, 42.6709], [-83.203615, 42.671334], [-83.204001, 42.671358], [-83.204259, 42.671168], [-83.20383, 42.670411], [-83.2031, 42.669804], [-83.199275, 42.669665]
          ]]
        }
      }
    },{
      "hole_number": 8,
      "par_men": 3,
      "par_ladies": 5,
      "handicap_men": 15,
      "handicap_ladies": 17,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.204248, 42.671754], [-83.204205, 42.671477], [-83.201705, 42.671186], [-83.201405, 42.671381], [-83.201523, 42.671635], [-83.204248, 42.671754]
          ]]
        }
      }
    },{
      "hole_number": 9,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 5,
      "handicap_ladies": 3,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.202671, 42.670562], [-83.202413, 42.670365], [-83.200547, 42.670294], [-83.199313, 42.670712], [-83.198294, 42.671675], [-83.198283, 42.672124], [-83.198465, 42.672284], [-83.198862, 42.672156], [-83.19993, 42.671243], [-83.200665, 42.670973], [-83.202671, 42.670562]
          ]]
        }
      }
    },{
      "hole_number": 10,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 6,
      "handicap_ladies": 8,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.195418, 42.672446], [-83.19556, 42.670327], [-83.196032, 42.668828], [-83.196483, 42.668765], [-83.19688, 42.669081], [-83.196472, 42.670509], [-83.195752, 42.672434], [-83.195418, 42.672446]
          ]]
        }
      }
    },{
      "hole_number": 11,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 16,
      "handicap_ladies": 14,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.197522, 42.668989], [-83.19779, 42.668808], [-83.197425, 42.667324], [-83.196664, 42.665691], [-83.196282, 42.665606], [-83.19602, 42.665778], [-83.196116, 42.666701], [-83.197134, 42.668859], [-83.197522, 42.668989]
          ]]
        }
      }
    },{
      "hole_number": 12,
      "par_men": 3,
      "par_ladies": 5,
      "handicap_men": 18,
      "handicap_ladies": 18,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.195847, 42.667188], [-83.196046, 42.667184], [-83.196228, 42.667117], [-83.195566, 42.665075], [-83.195201, 42.665036], [-83.19489, 42.665256], [-83.195847, 42.667188]
          ]]
        }
      }
    },{
      "hole_number": 13,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 2,
      "handicap_ladies": 2,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.195783, 42.664841], [-83.197983, 42.663587], [-83.199409, 42.663638], [-83.200193, 42.663445], [-83.200042, 42.663022], [-83.19795, 42.662927], [-83.197167, 42.663219], [-83.195556, 42.664632], [-83.195783, 42.664841]
          ]]
        }
      }
    },{
      "hole_number": 14,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 10,
      "handicap_ladies": 10,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.200352, 42.663303], [-83.200203, 42.663117], [-83.200191, 42.662821], [-83.200513, 42.66137], [-83.200963, 42.660723], [-83.202219, 42.660439], [-83.202601, 42.660569], [-83.202766, 42.660841], [-83.201875, 42.661086], [-83.20106, 42.662056], [-83.200352, 42.663303]
          ]]
        }
      }
    },{
      "hole_number": 15,
      "par_men": 3,
      "par_ladies": 5,
      "handicap_men": 14,
      "handicap_ladies": 16,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.202587, 42.661122], [-83.202727, 42.661517], [-83.203671, 42.661817], [-83.205366, 42.661856], [-83.20545, 42.661642], [-83.205205, 42.661375], [-83.202587, 42.661122]
          ]]
        }
      }
    },{
      "hole_number": 16,
      "par_men": 5,
      "par_ladies": 5,
      "handicap_men": 8,
      "handicap_ladies": 6,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.20686, 42.66204], [-83.206737, 42.661823], [-83.203969, 42.661966], [-83.201447, 42.662542], [-83.200718, 42.663292], [-83.201008, 42.663773], [-83.201297, 42.66386], [-83.20178, 42.663592], [-83.20207, 42.663003], [-83.20686, 42.66204]
          ]]
        }
      }
    },{
      "hole_number": 17,
      "par_men": 4,
      "par_ladies": 5,
      "handicap_men": 12,
      "handicap_ladies": 12,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.199642, 42.664244], [-83.199545, 42.663984], [-83.199087, 42.663938], [-83.198912, 42.66426], [-83.198408, 42.665126], [-83.197764, 42.667248], [-83.198054, 42.667398], [-83.198687, 42.667161], [-83.198977, 42.666104], [-83.199642, 42.664244]
          ]]
        }
      }
    },{
      "hole_number": 18,
      "par_men": 5,
      "par_ladies": 5,
      "handicap_men": 4,
      "handicap_ladies": 4,
      "tees": [
        {"name": "Tournament", "distance": 400},
        {"name": "Champion", "distance": 387}
      ],
      "geo": {
        "type": "Feature",
        "properties": {},
        "geometry": {
          "type": "Polygon",
          "coordinates": [[
            [-83.198376, 42.667372],[-83.198826, 42.667301],[-83.198762, 42.668366], [-83.196266, 42.672525],[-83.195876, 42.672539],[-83.195865, 42.671931], [-83.196648, 42.670142],[-83.197786, 42.668833],[-83.198279, 42.66787], [-83.198376, 42.667372]
          ]]
        }
      }
    }
  ];
  teeNames: string[] = this.holes[0].tees.map(a => a.name);
  submission = [];


  constructor(private courseService: CourseService, private route: ActivatedRoute,
              private fb: FormBuilder, private elementRef: ElementRef) {
    this.courseForm = this.fb.group({
      holes: this.fb.array([])
    });
    this.holes.map((item, index) => {
      this.addItem(item);
    });
  }

  ngOnInit(): void { }

  ngAfterViewInit(): void {
    this.initMap();
    const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    tiles.addTo(this.map);
    this.updateMap();
    this.map.fitBounds(this.courseMap.getBounds());
  }

  private initMap(): void {
    this.map = L.map('cMap', {
      center: [42.6730347, -83.196061],
      zoom: 15
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
        if (hole.geo === '')
          opt += '<option value="'+i+'">'+hole.hole_number+'</option>';
      }
      const _this = this;
      var popupContent = '<form id="add-geo"><div class="form-group">'+
        '<label class="control-label col-sm-5"><strong>Hole: </strong></label>'+
        '<select id="hole" name="geoHole" class="form-control">'+opt+'</select>'+
        '</div>'+
        '<input style="display: none;" type="text" name="geoCoords" value="'+coords+'" />'+
        '<div class="form-group">'+
        '<div style="text-align:center;" class="col-xs-4 col-xs-offset-2"><button type="button" class="btn">Cancel</button></div>'+
        '<div style="text-align:center;" class="col-xs-4"><button type="submit" class="btn btn-primary trigger-submit">Add</button></div>'+
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
        const i = this.holes.findIndex(h => h.hole_number === layer.options.id);
        this.courseForm.get(`holes.${layer.options.id}.geo`).setValue(
          layer.toGeoJSON()
        );
        console.log("Hole at index "+layer.options.id+" geo updated");
      });
    });

    this.map.on('draw:deleted', (e) => {
      var layers = e.layers;
      layers.eachLayer((layer) => {
        //do whatever you want; most likely save back to db
        if (layer.options.id !== false) {
          const i = this.holes.findIndex(h => h.hole_number === layer.options.id);
          this.courseForm.get(`holes.${layer.options.id}.geo`).setValue('');
          console.log("Hole at index " + layer.options.id + " geo removed");
        }
      });
    });
  }

  addGeo(i, coords) {
    //const points = coords[0].map(point => [point.lat, point.lng]);
    i = parseInt(i);
    const hole = this.courseForm.value.holes[i].hole_number;
    this.courseForm.get(`holes.${i}.geo`).setValue(coords);
    var layer = L.geoJSON(coords).getLayers()[0].setStyle({
      id: i,
      weight: 1,
      fillOpacity: 0.7,
      color: 'red',
      dashArray: '3'
    }).bindTooltip("Hole " + hole);
    this.courseMap.addLayer(layer);
  }

  updateMap() {
    this.courseMap.clearLayers();
    for (let [i, hole] of this.courseForm.value.holes.entries()) {
      try {
        var layer = L.geoJSON(hole.geo).getLayers()[0].setStyle({
          id: i,
          weight: 1,
          fillOpacity: 0.7,
          color: 'red',
          dashArray: '3'
        }).bindTooltip("Hole " + hole.hole_number);
        this.courseMap.addLayer(layer);
      } catch (e) {
        console.log(hole.hole_number);
      }
    }
  }

  addItem(item: any) {
    const tees = item.tees.map(x =>
      this.fb.group({
        name: [""],
        distance: [""]
      })
    );
    const geos = JSON.stringify(item.geo);

    const formItem = this.fb.group({
      hole_number: [],
      par_men: [],
      par_ladies: [],
      handicap_men: [],
      handicap_ladies: [],
      tees: this.fb.array([...tees]),
      geo: [geos]
    });
    formItem.setValue(item);
    (this.courseForm.get("holes") as FormArray).push(formItem);
  }

  addHole() {
    const item = {
      hole_number: this.courseForm.get("holes")['controls'].length + 1,
      par_men: null,
      par_ladies: null,
      handicap_men: null,
      handicap_ladies: null,
      tees: [...this.teeNames.map(x => ({ name: x, distance: null }))],
      geo: ''
    };
    this.addItem(item);
    this.updateMap();
  }

  addTee() {
    for (let hole of this.courseForm.get("holes")["controls"]) {
      (hole.get("tees") as FormArray).push(
        this.fb.group({
          name: [''],
          distance: ['']
        })
      );
    }
    this.teeNames.push('');
  }

  updateTee(t: number, event) {
    for (let hole of this.courseForm.get("holes")["controls"]) {
      hole.get(`tees.${t}.name`)
        .setValue(event.target.value, {emitEvent:false});
    }
    this.teeNames[t] = event.target.value;
  }

  removeTee(t: number) {
    for (let hole of this.courseForm.get("holes")["controls"]) {
      (hole.get("tees") as FormArray).removeAt(t);
    }
    this.teeNames.splice(t, 1);
  }
  removeHole(h: number) {
    (this.courseForm.get("holes") as FormArray).removeAt(h);
    this.updateMap();
  }

  updateCourse() {
    const holes = this.courseForm.value.holes;
    this.submission = holes;
  }
}
