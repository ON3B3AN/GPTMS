import { Component, OnInit } from '@angular/core';
import {AuthService} from '../auth.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.sass']
})
export class NavbarComponent implements OnInit {
  navbarOpen = false;
  isOpen = false;

  // tslint:disable-next-line: typedef
  toggleNavbar() {
    this.navbarOpen = !this.navbarOpen;
  }

  constructor(private authService: AuthService, public router: Router) { }

  ngOnInit(): void {
  }

  logout(): void {
    this.authService.logout();
  }

}
