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

  // tslint:disable-next-line: typedef
  onResize(e) {
    const toggleElement = document.getElementById('toggle') as HTMLInputElement;
    if (e.target.innerWidth < 500 && toggleElement.checked) {
      document.getElementById('container').style.height = '355px';
    }
    else {
      document.getElementById('container').style.height = '100%';
    }
  }
  // tslint:disable-next-line: typedef
  heightUpdate(e) {
    if (e.target.checked) {
      document.getElementById('container').style.height = '355px';
    }
    else {
      document.getElementById('container').style.height = '100%';
    }
  }

  constructor(private authService: AuthService, private router: Router) { }

  ngOnInit(): void {
  }

}
