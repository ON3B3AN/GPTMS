import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable} from "rxjs";
import {catchError, tap} from "rxjs/operators";
import {User} from "./user";

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private baseUrl = 'http://localhost/';  // URL to web api


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private http: HttpClient) { }

  getUser(id: number): Observable<User> {
    return new Observable();
  }

  getUserHistory(id: number): Observable<any> {
    return new Observable();
  }

  /**** Saving ****/

  addUser(user: User) { } // signup form submission

  updateUser(user: User): Observable<any> {
    return new Observable();
  } // user profile update
}
