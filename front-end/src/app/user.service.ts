import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Observable, of} from 'rxjs';
import {catchError, tap} from 'rxjs/operators';
import {Role, User} from './user';
import {MessageService} from "primeng/api";

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private userUrl = 'https://localhost/GPTMS/api/user-management/users';  // URL to web api
  private empUrl = 'https://localhost/GPTMS/api/employee-management/employees';  // URL to web api


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private http: HttpClient, private messageService: MessageService) { }

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

  getUserRoles(id: number): Observable<any> {
    const url = `${this.userUrl}/${id}/roles`;
    return this.http.get<any[]>(url)
      .pipe(
        tap(_ => console.log(`fetched roles for user id=${id}`)),
        catchError(this.handleError<any>(`getUserRoles id=${id}`))
      );
  }

  getEmployees(): Observable<any[]> {
    return this.http.get<any[]>(this.empUrl)
      .pipe(
        tap(_ => console.log(`fetched all employees`)),
        catchError(this.handleError<any[]>(`getEmployees`))
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
      tap(_ => console.log(`updated user w/ id=${user.user_id}`)),
      catchError(this.handleError<User>('updatedUser'))
    );
  } // user profile update

  addRole(user_id: number, role: any) {
    const url = `${this.userUrl}/${user_id}/roles`;
    return this.http.post<any>(url, {data: role}, this.httpOptions).pipe(
      tap(_ => console.log(`added role for user id=${user_id} on course id=${role.course_id}`)),
      catchError(this.handleError<any>('addRole'))
    );
  }

  updateRole(user_id: number, role: Role) {
    const url = `${this.userUrl}/${user_id}/roles`;
    return this.http.put<any>(url, {data: role}, this.httpOptions).pipe(
      tap(_ => console.log(`updated role for user id=${user_id} on course id=${role.course_id}`)),
      catchError(this.handleError<any>('updateRole'))
    );
  }

  deleteRole(user_id: number, course_id: number) {
    const url = `${this.userUrl}/${user_id}/roles`;
    const options = {...this.httpOptions};
    options['body'] = {data: {course_id}};
    return this.http.delete<any>(url, options).pipe(
      tap(_ => console.log(`deleted role for user id=${user_id} on course id=${course_id}`)),
      catchError(this.handleError<any>('updateRole'))
    );
  }



  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      this.messageService.add({severity: 'error', summary: 'Error', detail: error.error.message});

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
}
