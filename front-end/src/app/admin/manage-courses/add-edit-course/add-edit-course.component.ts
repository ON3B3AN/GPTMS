import { Component, Input, OnInit, OnChanges, Output, EventEmitter } from '@angular/core';
import { CourseService } from 'src/app/course.service';
import { Course } from 'src/app/course';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";

@Component({
  selector: 'app-add-edit-course',
  templateUrl: './add-edit-course.component.html',
  styleUrls: ['./add-edit-course.component.sass']
})
export class AddEditCourseComponent implements OnInit, OnChanges {
  @Input() course: Course;
  @Output() close = new EventEmitter<any>();
  editCourse: FormGroup;

  constructor(private formBuilder: FormBuilder) { }

  ngOnInit(): void {
    this.editCourse = this.formBuilder.group({
      course_name: [this.course.course_name],
      address: [this.course.address],
      phone_number: [this.course.phone_number]
    });
  }

  ngOnChanges(): void {
    console.log(this.course);
    this.editCourse.controls['course_name'].setValue(this.course.course_name);
  }

  ok() {
    this.close.emit(this.course);
  }

  cancel() {
    this.close.emit(null);
  }

}
