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
  userForm: FormGroup;
  user: User;

  constructor(private authService: AuthService, private userService: UserService, private formBuilder: FormBuilder) { }

  ngOnInit(): void {
    this.user = this.authService.currentUser;
    this.userForm  =  this.formBuilder.group({
      first_name: [this.user.first_name, Validators.required],
      last_name: [this.user.last_name, Validators.required],
      phone: [this.user.phone, Validators.required],
      email: [this.user.email, [Validators.required, Validators.email]],
      password: [''],
      password_conf: ['']
    },
      {validator: this.passwordMatchValidator});
  }

  passwordMatchValidator(frm: FormGroup) {
    return frm.controls['password'].value ===
    frm.controls['password_conf'].value ? null : {'mismatch': true};
  }

  get formControls() { return this.userForm.controls; }

}
