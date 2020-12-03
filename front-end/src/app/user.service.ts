import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, of} from 'rxjs';
import {catchError, tap} from 'rxjs/operators';
import {User} from './user';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private userUrl = 'https://localhost/GPTMS/api/user-management/users';  // URL to web api
  private empUrl = 'https://localhost/GPTMS/api/employee-management/employees';  // URL to web api


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private http: HttpClient) { }

  getUsers(): Observable<User[]> {
    return this.http.get<User[]>(this.userUrl)
      .pipe(
        tap(_ => console.log(`fetched all users`)),
        catchError(this.handleError<User[]>(`getUsers`))
      );
  }

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

  addUser(user: User) {
    console.log(user);
    return this.http.post<User>(this.userUrl, {data: user}, this.httpOptions).pipe(
      tap((newUser: User) => console.log(`added user w/ id=${newUser.user_id}`)),
      catchError(this.handleError<User>('addUser'))
    );
  } // signup form submission

  updateUser(user: User): Observable<any> {
    const url = `${this.userUrl}/${user.user_id}`;
    return this.http.put<User>(url, {data: user}, this.httpOptions).pipe(
      tap((newUser: User) => console.log(`updated user w/ id=${user.user_id}`)),
      catchError(this.handleError<User>('updatedUser'))
    );
  } // user profile update

  getEmployees(): Observable<any[]> {
    return this.http.get<any[]>(this.empUrl)
      .pipe(
        tap(_ => console.log(`fetched all employees`)),
        catchError(this.handleError<any[]>(`getEmployees`))
      );
  }

  addEmployee(emp: any) {
    console.log(emp);
    return this.http.post<any>(this.empUrl, {data: emp}, this.httpOptions).pipe(
      tap((newEmp: any) => console.log(`added employee w/ id=${newEmp.emp_id}`)),
      catchError(this.handleError<any>('addEmployee'))
    );
  }



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
