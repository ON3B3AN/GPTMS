import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import { Router } from "@angular/router";
import {BehaviorSubject, Observable, of, throwError} from 'rxjs';
import {catchError, map} from "rxjs/operators";
import {User} from "./user";

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private baseUrl = 'http://localhost';  // URL to web api
  private userSubject: BehaviorSubject<any>;
  public user: Observable<User>;


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private router: Router, private http: HttpClient) {
    this.userSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('user')));
    this.user = this.userSubject.asObservable();
  }

  public login(userData: User){
    return this.http.post(this.baseUrl + '/index.php', { action: 'login', data: userData })
      .pipe(map((user) => {
        // store user details and basic auth credentials in local storage to keep user logged in between page refreshes
        localStorage.setItem('user', JSON.stringify(user));
        this.userSubject.next(user);
        return user;
      }),
        catchError(this.handleError));
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

  private handleError(error: HttpErrorResponse) {
    console.log(error);

    // return an observable with a user friendly message
    return throwError('Error! something went wrong.');
  }
}
