import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse, HttpHeaders} from '@angular/common/http';
import { Router } from '@angular/router';
import {BehaviorSubject, Observable, of, throwError} from 'rxjs';
import {catchError, map} from 'rxjs/operators';
import {MessageService} from 'primeng/api';
import {User} from './user';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private baseUrl = 'https://localhost/GPTMS/api/user-management/users';  // URL to web api
  private userSubject: BehaviorSubject<any>;
  public user: Observable<User>;


  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private router: Router, private http: HttpClient, private messageService: MessageService) {
    this.userSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('user')));
    this.user = this.userSubject.asObservable();
  }

  public login(userData: User) {
    return this.http.post(this.baseUrl + '/login', {data: userData})
      .pipe(map((user) => {
        // store user details and basic auth credentials in local storage to keep user logged in between page refreshes
        localStorage.setItem('user', JSON.stringify(user));
        this.userSubject.next(user);
        return user;
      }),
        catchError(this.handleError('login')));
  }

  public isLoggedIn(): boolean {
    return localStorage.getItem('user') !== null;
  }

  public get currentUser(): Observable<User> {
    return this.user;
  }

  public logout() {
    localStorage.removeItem('user');
    this.userSubject.next(null);
    this.router.navigate(['/login']);
  }

  private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead
      this.messageService.add({severity: 'error', summary: 'Error', detail: error.error.message});
      // TODO: better job of transforming error for user consumption
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
}
