import { Injectable } from '@angular/core';
import {BehaviorSubject, Observable, of} from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import {User} from './user';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class GameService {
  private gameUrl = 'https://localhost/GPTMS/api/party-management/parties';

  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };
  watchId: number;

  constructor(private http: HttpClient, private router: Router) {}

  startGame(info: any) {
    console.log(info);
    return this.http.post<any>(this.gameUrl, {data: info}, this.httpOptions).pipe(
      tap((newParty: any) => console.log(`added party id=${newParty}`)),
      catchError(this.handleError<any>('addParty'))
    );
  }

  endGame() {
    localStorage.removeItem('game');
    localStorage.removeItem('cHole');
    this.router.navigate(['/landing']);
  }

  getRound(party, course, start_hole, end_hole) {
    const url = `${this.gameUrl}/${party}/rounds`;
    return this.http.post<any>(url,{data: {course_id: course, start_hole: start_hole, end_hole: end_hole}})
      .pipe(
        tap(_ => console.log(`fetched round info`)),
        catchError(this.handleError<any>(`getRound`))
      );
  }

  addScore(party, hole, user, stroke): Observable<any> {
    const url = `${this.gameUrl}/${party}/scores`;
    return this.http.post<any>(url, {data: {Hole_hole_id: hole, Player_User_user_id: user, stroke: stroke, total_score: 0}}, this.httpOptions).pipe(
      tap((newScore: any) => console.log(`added score for party id=${newScore.course_id}`)),
      catchError(this.handleError<any>('addScore'))
    );
  }

  updateScore() {

  }

  updatePartyGeo(party, lon, lat) {
    const url = `${this.gameUrl}/${party}/coordinates`
    return this.http.put(url, {data: {longitude: lon, latitude: lat}}, this.httpOptions).pipe(
      tap(_ => console.log(`updated party coord w/ id=${party}`)),
      catchError(this.handleError<any>('updatedPartyCoord'))
    );
  }

  requestService(party){
    const url = `${this.gameUrl}/${party}/request-services`;
    return this.http.get<any>(url)
      .pipe(
        tap(_ => alert('Services Requested')),
        catchError(this.handleError<any>(`getRequestedService id=${party}`))
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
