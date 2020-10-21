import {AfterViewInit, Component, OnInit} from '@angular/core';
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

  constructor(private courseService: CourseService, private route: ActivatedRoute) { }

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
  }

  private initMap(): void {
    this.map = L.map('map', {
      center: [ 42.331429, -83.045753 ],
      zoom: 12
    });
  }
}
