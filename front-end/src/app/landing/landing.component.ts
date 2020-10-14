import { Component, OnInit } from '@angular/core';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {Router} from '@angular/router';
import { User } from  '../user';
import {AuthService} from '../auth.service';


@Component({
  selector: 'app-home',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.sass']
})
export class LandingComponent implements OnInit {

  constructor(private authService: AuthService, private router: Router) { }

  ngOnInit(): void {
  }

}
