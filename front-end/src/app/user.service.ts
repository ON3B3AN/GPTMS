import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from "@angular/common/http";
import {Observable, of} from "rxjs";
import {catchError, tap} from "rxjs/operators";
import {User} from "./user";

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private userUrl = 'http://localhost/GPTMS/api/users';  // URL to web api


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private http: HttpClient) { }

  getUser(id: number): Observable<User> {
    const url = `${this.userUrl}/${id}`;
    return this.http.get<User>(url)
      .pipe(
        tap(_ => console.log(`fetched user id=${id}`)),
        catchError(this.handleError<User>(`getUser id=${id}`))
      );
  }

  getUserHistory(id: number): Observable<any> {
    const url = `${this.userUrl}/${id}/history`;
    return this.http.get<any>(url)
      .pipe(
        tap(_ => console.log(`fetched history for user id=${id}`)),
        catchError(this.handleError<any>(`getUserHistory id=${id}`))
      );
  }

  /**** Saving ****/

  addUser(user: User) { } // signup form submission

  updateUser(user: User): Observable<any> {
    return new Observable();
  } // user profile update

  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
}