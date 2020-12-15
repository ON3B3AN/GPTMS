import { Component, Input, OnInit, OnChanges, Output, EventEmitter } from '@angular/core';
import { CourseService } from 'src/app/course.service';
import { Course } from 'src/app/course';
import {FormBuilder, FormGroup, Validators, ReactiveFormsModule} from "@angular/forms";

@Component({
  selector: 'app-add-edit-course',
  templateUrl: './add-edit-course.component.html',
  styleUrls: ['./add-edit-course.component.sass']
})
export class AddEditCourseComponent implements OnInit, OnChanges {
  @Input() course: Course;
  @Output() close = new EventEmitter<any>();
  editCourse: FormGroup;
  title: string = 'Add Course';

  constructor(private formBuilder: FormBuilder, private courseService: CourseService) {
    this.editCourse = this.formBuilder.group({
      course_name: [''],
      address: [''],
      phone: ['']
    });
  }

  ngOnInit(): void { }

  ngOnChanges(): void {
    if (this.course.course_id) {
      this.title = 'Edit Course';
      this.editCourse.patchValue(this.course);
    } else {
      this.title = 'Add Course';
      this.editCourse.reset();
    }
  }

  ok() {
    const course = this.editCourse.value;
    if (this.course.course_id) {
      course.course_id = this.course.course_id;
      this.courseService.updateCourse(course).subscribe();
    } else {
      this.courseService.addCourse(course).subscribe();
    }
    this.close.emit(course);
  }

  cancel() {
    this.close.emit(null);
  }

}
