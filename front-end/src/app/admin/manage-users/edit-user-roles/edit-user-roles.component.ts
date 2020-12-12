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
  roles = [];

  constructor(private formBuilder: FormBuilder, private userService: UserService,
              private courseService: CourseService) {
    this.courseService.getCourses()
    .subscribe(data => this.courses = data);
  }

  ngOnInit(): void {
    this.user = new User();
    this.editRole = this.formBuilder.group({
    });

  }

  ngOnChanges(): void {
    this.user = new User();
    console.log(this.id);
    if (this.id) {
      this.userService.getUsers()
        .subscribe(data => {
          this.user = data.filter(i => i.user_id == this.id)[0];
          this.editRole.patchValue(this.user);
        });

      this.userService.getEmployees()
        .subscribe(data => {
          this.roles = data.filter(i => i.User_user_id === this.id);
          this.editRole.patchValue(this.roles);
          for (let role of this.roles) {
            role.course_name = this.courses.filter(i => i.course_id === role.Course_course_id)[0].course_name;
          }
        });
    }

    this.userService.getUsers()
      .subscribe(data => this.users = data);
  }

  ok(): void {
    this.close.emit(this.user);
  }

  deleteRole(course): void {}

  cancel(): void {
    this.close.emit(null);
  }

}
