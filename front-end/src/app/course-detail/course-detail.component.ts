import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import {CourseService} from '../course.service';
import {Course} from '../course';

@Component({
  selector: 'app-course-detail',
  templateUrl: './course-detail.component.html',
  styleUrls: ['./course-detail.component.sass']
})
export class CourseDetailComponent implements OnInit {
  id: number;
  course: Course;

  constructor(private courseService: CourseService, private route: ActivatedRoute) { }

  ngOnInit(): void {
    this.route.params.subscribe(params => {
      this.id = +params.id;
    });
    this.courseService.getCourse(this.id)
      .subscribe(data => this.course = data);
  }

}
