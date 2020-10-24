import {AfterViewInit, Component, OnInit} from '@angular/core';
import {MatTableDataSource} from '@angular/material/table';
import {ActivatedRoute} from '@angular/router';
import * as L from 'leaflet';

import {CourseService} from '../course.service';
import {Course} from '../course';

@Component({
  selector: 'app-course-detail',
  templateUrl: './course-detail.component.html',
  styleUrls: ['./course-detail.component.sass']
})
export class CourseDetailComponent implements OnInit, AfterViewInit {
  id: number;
  course: Course;
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
  labels = ['Hole','Distance','Par'];
  tees = ['Black','Blue'];
  holes = [
    {'hole_id':'1','course_id':'1','hole_number':'1','hole_par':'5','hole_distance':[475, 100]},
    {'hole_id':'2','course_id':'1','hole_number':'2','hole_par':'4','hole_distance':[519, 100]},
    {'hole_id':'3','course_id':'1','hole_number':'3','hole_par':'3','hole_distance':[184, 100]},
    {'hole_id':'4','course_id':'1','hole_number':'4','hole_par':'4','hole_distance':[350, 100]},
    {'hole_id':'5','course_id':'1','hole_number':'5','hole_par':'4','hole_distance':[398, 100]},
    {'hole_id':'6','course_id':'1','hole_number':'6','hole_par':'5','hole_distance':[551, 100]},
    {'hole_id':'7','course_id':'1','hole_number':'7','hole_par':'4','hole_distance':[456, 100]},
    {'hole_id':'8','course_id':'1','hole_number':'8','hole_par':'3','hole_distance':[203, 100]},
    {'hole_id':'9','course_id':'1','hole_number':'9','hole_par':'4','hole_distance':[439, 100]},
    {'hole_id':'10','course_id':'1','hole_number':'10','hole_par':'4','hole_distance':[426, 100]},
    {'hole_id':'11','course_id':'1','hole_number':'11','hole_par':'4','hole_distance':[414, 100]},
    {'hole_id':'12','course_id':'1','hole_number':'12','hole_par':'3','hole_distance':[202, 100]},
    {'hole_id':'13','course_id':'1','hole_number':'13','hole_par':'4','hole_distance':[460, 100]},
    {'hole_id':'14','course_id':'1','hole_number':'14','hole_par':'4','hole_distance':[372, 100]},
    {'hole_id':'15','course_id':'1','hole_number':'15','hole_par':'3','hole_distance':[215, 100]},
    {'hole_id':'16','course_id':'1','hole_number':'16','hole_par':'5','hole_distance':[562, 100]},
    {'hole_id':'17','course_id':'1','hole_number':'17','hole_par':'4','hole_distance':[374, 100]},
    {'hole_id':'18','course_id':'1','hole_number':'18','hole_par':'5','hole_distance':[625, 100]}
  ]
  dataColumns = [
    'hole_number',
    'hole_distance',
    'hole_par'
  ];
  displayedColumns = [];

  constructor(private courseService: CourseService, private route: ActivatedRoute) {
    this.transpose();
    this.fillLabels();
  }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.id = +params.id;
    });
    this.courseService.getCourse(this.id)
      .subscribe(data => this.course = data);

  }

  ngAfterViewInit(): void {
    this.initMap();
    const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    tiles.addTo(this.map);
    // const marker = L.marker([ 42.42753075, -83.12527904 ], this.icon).addTo(this.map);
    this.geocodeAddress(this.course.address).then(json => {
      const marker = L.marker([json[0].lat, json[0].lon], this.icon).addTo(this.map);
      this.map.panTo(marker.getLatLng());
    });
  }

  private initMap(): void {
    this.map = L.map('map', {
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
    const addedTees = [1, 1].concat(this.tees);
    Array.prototype.splice.apply(this.labels, addedTees)
    this.addTees();
    for (let column = 0; column < this.dataColumns.length; column++) {
      let tee = -1;
      let lbl = this.labels[column];
      if (this.dataColumns[column].startsWith('hole_distance')) {
        tee = parseInt(this.dataColumns[column].substr(-1));
      }
      transposedData[column] = {
        label: lbl
      };
      for (let row = 0; row < this.holes.length; row++) {
        if (tee !== -1) {
          transposedData[column][`column${row}`] = this.holes[row]['hole_distance'][tee];
        } else {
          transposedData[column][`column${row}`] = this.holes[row][this.dataColumns[column]];
        }
      }
    }
    this.dataSource = new MatTableDataSource(transposedData);
  }

  fillLabels() {
    this.displayedColumns = ['label'];
    for (let i = 0; i < this.holes.length; i++) {
      this.displayedColumns.push('column' + i);
    }
  }

  addTees() {
    let i = this.dataColumns.indexOf('hole_distance');
    this.dataColumns[i] = 'hole_distance-0';
    for (let n = 1; n < this.tees.length; n++) {
      i++;
      this.dataColumns.splice(i,0, 'hole_distance-'+n);
    }
  }
}
