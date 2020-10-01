import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from "@angular/router";
import { BehaviorSubject, Observable, of } from 'rxjs';
import { map } from "rxjs/operators";
import {User} from "./user";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private baseUrl = 'http://localhost/GPTMS/GPTMS/api';  // URL to web api
  private userSubject: BehaviorSubject<User>;
  public user: Observable<User>;


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private router: Router, private http: HttpClient) {
    this.userSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('user')));
    this.user = this.userSubject.asObservable();
  }

  public login(userData: User){
    console.log(JSON.stringify({ action: 'login', data: userData }));
    return this.http.post('${this.baseUrl}/User/profileController.php', { action: 'login', data: userData })
      .pipe(map(user => {
        // store user details and basic auth credentials in local storage to keep user logged in between page refreshes
        localStorage.setItem('user', JSON.stringify(user));
        this.userSubject.next(user);
        return user;
        this.router.navigate(['/landing']);
      }));
  }
  public isLoggedIn(){
    return localStorage.getItem('user') !== null;
  }
  public logout(){
    localStorage.removeItem('user');
    this.userSubject.next(null);
    this.router.navigate(['/login']);
  }
  public signUp(userData: User){
  }
}
