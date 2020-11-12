import { Injectable } from '@angular/core';
import {BehaviorSubject, Observable, of} from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {User} from './user';

@Injectable({
  providedIn: 'root'
})
export class GameService {
  private gameUrl = 'http://localhost/party-management/parties';

  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };
  constructor(private http: HttpClient) {}

  startGame() {

  }

  endGame() {

  }

  addScore(party, hole, user, stroke): Observable<any> {
    const url = `${this.gameUrl}/${party}/scores`;
    return this.http.post<any>(url, {data: {hole_id: hole, user_id: user, stroke: stroke}}, this.httpOptions).pipe(
      tap((newScore: any) => console.log(`added score for party id=${newScore.course_id}`)),
      catchError(this.handleError<any>('addScore'))
    );
  }

  updateScore() {

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
