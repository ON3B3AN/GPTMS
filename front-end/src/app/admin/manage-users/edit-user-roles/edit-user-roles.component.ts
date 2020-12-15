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
  cWithRoles = [];
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

  }

  ngOnChanges(): void {
    this.user = new User();
    if (this.id) {
      this.userService.getUsers()
        .subscribe(data => {
          this.user = data.filter(i => i.user_id === this.id)[0];
        });

      this.refresh();
    }

    this.userService.getUsers()
      .subscribe(data => this.users = data);
  }

  ok(): void {
    this.close.emit(this.user);
  }

  deleteRole(course): void {
    this.userService.deleteRole(this.id, course).subscribe(_ =>
      this.refresh());
  }

  updateRole(course, e): void {
    const role = {course_id: course, security_lvl: e.target.value};
    this.userService.updateRole(this.id, role).subscribe(_ =>
      this.refresh());
  }

  addRole(e): void {
    if (!this.cWithRoles.includes(e.target.value)) {
      const role = {course_id: e.target.value, security_lvl: 2};
      this.userService.addRole(this.id, role).subscribe(_ =>
        this.refresh());
    }
  }

  cancel(): void {
    this.close.emit(null);
  }

  refresh(): void {
    this.cWithRoles = [];
    this.userService.getUserRoles(this.id)
      .subscribe(data => {
        this.roles = data;
        for (const role of this.roles) {
          this.cWithRoles.push(role.Course_course_id);
          role.course_name = this.courses.filter(i => i.course_id === role.Course_course_id)[0].course_name;
        }
      });
  }

}
