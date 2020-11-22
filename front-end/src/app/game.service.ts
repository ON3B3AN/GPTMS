import { Injectable } from '@angular/core';
import {BehaviorSubject, Observable, of} from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {User} from './user';

@Injectable({
  providedIn: 'root'
})
export class GameService {
  private gameUrl = 'http://localhost/GPTMS/api/party-management/parties';

  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };
  constructor(private http: HttpClient) {}

  startGame(info: any) {
    console.log(info);
    return this.http.post<any>(this.gameUrl, {data: info}, this.httpOptions).pipe(
      tap((newParty: any) => console.log(`added party id=${newParty}`)),
      catchError(this.handleError<any>('addParty'))
    );
  }

  endGame() {

  }

  getRound(course, start_hole, end_hole) {
    const url = `${this.gameUrl}/start-round`;
    return this.http.post<any>(url,{data: {course_id: course, start_hole: start_hole, end_hole: end_hole}})
      .pipe(
        tap(_ => console.log(`fetched round info`)),
        catchError(this.handleError<any>(`getRound`))
      );
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
