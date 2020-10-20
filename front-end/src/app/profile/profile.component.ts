import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {AuthService} from "../auth.service";
import {UserService} from "../user.service";
import {User} from "../user";


@Component({
  selector: 'app-profile',
  templateUrl: './profile.component.html',
  styleUrls: ['./profile.component.sass']
})
export class ProfileComponent implements OnInit {

  constructor(private authService: AuthService, private userService: UserService, private formBuilder: FormBuilder) { }
  userForm: FormGroup;
  user: User;

  ngOnInit(): void {
    this.user = this.authService.currentUser;
    this.userForm  =  this.formBuilder.group({
      first_name: [this.user.first_name, Validators.required],
      last_name: [this.user.last_name, Validators.required],
      phone: [this.user.phone, Validators.required],
      email: [this.user.email, [Validators.required, Validators.email]],
      password: ['']
    });
  }

  get formControls() { return this.userForm.controls; }

}
