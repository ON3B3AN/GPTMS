import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthService } from '../auth.service';


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



  constructor(private authService: AuthService, private router: Router) { }

  ngOnInit(): void {
  }

  logout(): void {
    this.authService.logout();
    this.router.navigateByUrl('/login');
  }

}
