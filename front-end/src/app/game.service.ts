import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import { Router } from '@angular/router';
import {BehaviorSubject, Observable, of, throwError} from 'rxjs';
import {catchError, map} from 'rxjs/operators';
import {User} from './user';

@Injectable({
  providedIn: 'root'
})
export class GameService {

  private baseUrl = 'http://localhost/course-management/courses/1/holes';

  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };
  constructor(private router: Router, private http: HttpClient) {}

  public begin() {

  }
}
