import { Component, Input, OnInit, OnChanges, Output, EventEmitter, SimpleChanges } from '@angular/core';
import { UserService } from 'src/app/user.service';
import {FormBuilder, FormGroup, Validators, ReactiveFormsModule} from "@angular/forms";
import { User } from 'src/app/user';
import { Course } from 'src/app/course';
import { CourseService } from 'src/app/course.service';

@Component({
  selector: 'app-edit-user-roles',
  templateUrl: './edit-user-roles.component.html',
  styleUrls: ['./edit-user-roles.component.sass']
})
export class EditUserRolesComponent implements OnInit, OnChanges {
  @Input() id: number;
  @Output() close = new EventEmitter<any>();
  courses: Course[] = [];
  user: User;
  users: User[];
  editRole: FormGroup;
  title: string = 'View/Change Role';

  constructor(private formBuilder: FormBuilder, private userService: UserService, private courseService: CourseService) { }
  
  ngOnInit(): void {
    this.user = new User();
    this.editRole = this.formBuilder.group({
    });
    this.courseService.getCourses()
    .subscribe(data => this.courses = data);
  }

  ngOnChanges(): void {
    this.user = new User();
    console.log(this.id);
    if (this.id) {
      this.title = 'Change User Role';
      this.userService.getUsers()
        .subscribe(data => {
          this.user = data.filter(i => i.user_id = this.id)[0];
          this.editRole.patchValue(this.user);
        });
    }

    this.userService.getUsers()
      .subscribe(data => this.users = data);
  }

  ok() {
    this.close.emit(this.user);
  }

  deleteCourse(id): void {}

  cancel() {
    this.close.emit(null);
  }

}
