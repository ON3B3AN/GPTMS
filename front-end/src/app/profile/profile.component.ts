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

  constructor(private authService: AuthService, private userService: UserService, private formBuilder: FormBuilder) {
    this.authService.currentUser.subscribe(u => {
      this.user = u;
    });
  }

  ngOnInit(): void {
    this.userForm  =  this.formBuilder.group({
      user_id: [this.user.user_id],
      first_name: [this.user.first_name, Validators.required],
      last_name: [this.user.last_name, Validators.required],
      phone: [this.user.phone, Validators.required],
      email: [this.user.email, [Validators.required, Validators.email]],
      password: [''],
      check_password: ['']
    },
      {validator: this.passwordMatchValidator});
  }

  passwordMatchValidator(frm: FormGroup) {
    return frm.controls['password'].value ===
    frm.controls['check_password'].value ? null : {'mismatch': true};
  }

  get formControls() { return this.userForm.controls; }

  updateProfile() {
    if(this.userForm.invalid){
      return;
    }

    this.userService.updateUser(this.userForm.value).subscribe();
  }
}
