import { Component, OnInit } from '@angular/core';
import {CourseService} from "../../course.service";
import {Course} from "../../course";

@Component({
  selector: 'app-manage-courses',
  templateUrl: './manage-courses.component.html',
  styleUrls: ['./manage-courses.component.sass']
})
export class ManageCoursesComponent implements OnInit {
  courses: Course[];
  selectedCourse: Course;
  showEditor = false;

  constructor(private courseService: CourseService) { }

  ngOnInit(): void {
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);
  }

  editCourse(course?: Course): void {
    this.selectedCourse = course;
    this.showEditor = true;
  }

  deleteCourse(id): void {}

  closeModal(course: Course) {
    this.showEditor = false;
    if (course) console.log("WOOT!");
  }
}
