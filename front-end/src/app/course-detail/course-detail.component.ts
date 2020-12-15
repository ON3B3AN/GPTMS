import {Component, OnInit} from '@angular/core';
import {MatTableDataSource} from '@angular/material/table';
import {ActivatedRoute} from '@angular/router';
import * as L from 'leaflet';

import {CourseService} from '../course.service';
import {Course} from '../course';
import {AuthService} from "../auth.service";

@Component({
  selector: 'app-course-detail',
  templateUrl: './course-detail.component.html',
  styleUrls: ['./course-detail.component.sass']
})
export class CourseDetailComponent implements OnInit {
  id: number;
  course: Course;
  user;
  staff = null;

  constructor(private authService: AuthService, private courseService: CourseService, private route: ActivatedRoute) {  }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.id = +params.id;
    });
    this.authService.currentUser.subscribe(u => {
      this.user = u;
      const roles = this.user.roles.filter(x => x.Course_course_id === this.id);
      if (roles.length) {
        this.staff = roles[0].security_lvl;
      }
    });
    this.courseService.getCourse(this.id)
      .subscribe(data => this.course = data);
  }

  activate(component) {
    component.course = this.course;
  }
}
