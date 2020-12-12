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
  @Input() id: number;
  @Output() close = new EventEmitter<any>();
  course: Course;
  editCourse: FormGroup;
  title: string = 'Add Course';

  constructor(private formBuilder: FormBuilder, private courseService: CourseService) { }

  ngOnInit(): void {
    this.course = new Course();
    this.editCourse = this.formBuilder.group({
      course_name: [''],
      address: [''],
      phone: ['']
    });
  }

  ngOnChanges(): void {
    this.course = new Course();
    if (this.id) {
      this.title = 'Edit Course';
      this.courseService.getCourse(this.id)
        .subscribe(data => {
          this.course = data;
          console.log(data);
          this.editCourse.patchValue(this.course);
        });
    } else {
      this.title = 'Add Course';
      this.editCourse.reset();
    }
  }

  ok() {
    this.close.emit(this.course);
  }

  cancel() {
    this.close.emit(null);
  }

}
