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
>>>>>>> 7749aae4b0c29c595f3b752765187b0964b3212b
