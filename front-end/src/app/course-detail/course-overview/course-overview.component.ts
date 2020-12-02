import { Component, OnInit, Host } from '@angular/core';
import {MatTableDataSource} from '@angular/material/table';
import * as L from 'leaflet';
import { Course } from 'src/app/course';
import { CourseService } from 'src/app/course.service';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-course-overview',
  templateUrl: './course-overview.component.html',
  styleUrls: ['./course-overview.component.sass']
})
export class CourseOverviewComponent implements OnInit {
  course: Course;
  id: number;
  private map;
  icon = {
    icon: L.icon({
      iconSize: [ 25, 41 ],
      iconAnchor: [ 13, 0 ],
      // specify the path here
      iconUrl: 'assets/marker-icon.png',
      shadowUrl: 'assets/marker-shadow.png'
    })
  };

  dataSource: MatTableDataSource<any>;
  labels = ['Hole', 'Distance', 'Par'];
  tees = [];
  dataColumns = [
    'hole_number',
    'tees',
    'hole_par'
  ];
  displayedColumns = [];

  constructor(private courseService: CourseService, private route: ActivatedRoute) {  }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.id = +params.id;
    });
    this.courseService.getCourse(this.id)
      .subscribe(data => {
        this.course = data;
        this.transpose();
        this.fillLabels();
      });
  }

  ngAfterViewInit(): void {
    this.initMap();
    const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    tiles.addTo(this.map);
    console.log(this.course);
    this.geocodeAddress(this.course.address).then(json => {
      const marker = L.marker([json[0].lat, json[0].lon], this.icon).addTo(this.map);
      this.map.panTo(marker.getLatLng());
    });
  }

  private initMap(): void {
    this.map = L.map('oMap', {
      center: [ 42.42283075, -83.12516904 ],
      zoom: 14
    });
  }

  private geocodeAddress(address: string): Promise<any> {
    const json = fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURI(address)).then(function(response) {
      return response.json();
    });
    return json;
  }

  transpose() {
    let transposedData = [];
    // @ts-ignore
    this.addTees();
    const addedTees = [1, 1].concat(this.tees);
    Array.prototype.splice.apply(this.labels, addedTees)
    for (let column = 0; column < this.dataColumns.length; column++) {
      let tee = -1;
      let lbl = this.labels[column];
      if (this.dataColumns[column].startsWith('tees')) {
        tee = parseInt(this.dataColumns[column].substr(-1));
      }
      transposedData[column] = {
        label: lbl
      };
      for (let row = 0; row < this.course.holes.length; row++) {
        if (tee !== -1) {
          transposedData[column][`column${row}`] = this.course.holes[row]['tees'][tee]['distance_to_pin'];
        } else {
          transposedData[column][`column${row}`] = this.course.holes[row][this.dataColumns[column]];
        }
      }
    }
    this.dataSource = new MatTableDataSource(transposedData);
  }

  fillLabels() {
    this.displayedColumns = ['label'];
    for (let i = 0; i < this.course.holes.length; i++) {
      this.displayedColumns.push('column' + i);
    }
  }

  addTees() {
    let i = this.dataColumns.indexOf('tees');
    this.dataColumns[i] = 'tees-0';
    this.tees.push(this.course.holes[0]['tees'][0]['tee_name']);
    for (let n = 1; n < this.course.holes[0]['tees'].length; n++) {
      i++;
      this.dataColumns.splice(i,0, 'tees-'+n);
      this.tees.push(this.course.holes[0]['tees'][n]['tee_name']);
    }
  }
}
