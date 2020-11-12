import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import { User } from  '../user';
import {UserService} from '../user.service';

@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.sass']
})
export class SignupComponent implements OnInit {
  constructor(private userService: UserService, private router: Router, private formBuilder: FormBuilder) { }
  authForm: FormGroup;
  isSubmitted  =  false;


  ngOnInit(): void {
    this.authForm = this.formBuilder.group({
      first_name: ['', Validators.required],
      last_name: ['', Validators.required],
      phone: ['', Validators.required],
      email: ['', Validators.required],
      password: ['', Validators.required]

    })
  }
  get formControls() { return this.authForm.controls; }

  signUp(): void {
    this.isSubmitted = true;
    if(this.authForm.invalid){
      return;
    }
    this.userService.addUser(this.authForm.value).subscribe();
    this.router.navigateByUrl('/login');
  }
}
