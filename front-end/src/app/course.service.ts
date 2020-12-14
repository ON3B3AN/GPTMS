import { Injectable } from '@angular/core';
import {BehaviorSubject, Observable, of} from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import {HttpClient, HttpHeaders} from '@angular/common/http';
import { Course } from './course';
import { Hole } from './hole';
import {MessageService} from "primeng/api";


@Injectable({
  providedIn: 'root'
})
export class CourseService {
  private courseUrl = 'https://localhost/GPTMS/api/course-management/courses';  // URL to web api



  httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor( private http: HttpClient, private messageService: MessageService ) { }

  getCourses(): Observable<Course[]> {
    return this.http.get<Course[]>(this.courseUrl + '/')
      .pipe(
        tap(_ => console.log('fetched courses')),
        catchError(this.handleError<Course[]>('getCourses', []))
      );
  }

  getCourse(id: number): Observable<Course> {
    const url = `${this.courseUrl}/${id}/records`;
    return this.http.get<Course>(url)
      .pipe(
        tap(_ => console.log(`fetched course id=${id}`)),
        catchError(this.handleError<Course>(`getCourse id=${id}`))
      );
  }

  getHoles(id: number): Observable<Hole[]> {
    const url = `${this.courseUrl}/${id}/holes`;
    return this.http.get<Hole[]>(url)
      .pipe(
        tap(_ => console.log(`fetched hole id=${id}`)),
        catchError(this.handleError<Hole[]>(`getHole id=${id}`))
      );
  }

  getTees(id: number): Observable<Course> {
    const url = `${this.courseUrl}/${id}/tees`;
    return this.http.get<Course>(url)
      .pipe(
        tap(_ => console.log(`fetched Tee id=${id}`)),
        catchError(this.handleError<Course>(`getTee id=${id}`))
      );
  }

  /**** Saving ****/

  addCourse(course: Course): Observable<Course> {
    return this.http.post<Course>(this.courseUrl + '/', {data: course}, this.httpOptions).pipe(
      tap((newCourse: Course) => console.log(`added course w/ id=${newCourse.course_id}`)),
      catchError(this.handleError<Course>('addCourse'))
    );
  }

  updateCourse(course: Course): Observable<any> {
    const url = `${this.courseUrl}/${course.course_id}`;
    return this.http.post(url, {data: course}, this.httpOptions).pipe(
      tap(_ => console.log(`updated course id=${course.course_id}`)),
      catchError(this.handleError<any>('updateCourse'))
    );
  }

  updateHoles(courseId: number, holes: any): Observable<Hole[]> {
    const url = `${this.courseUrl}/${courseId}/holes`;
    return this.http.put<any>(url, {data: holes}, this.httpOptions)
      .pipe(
        tap(_ => console.log(`updated holes for course id=${courseId}\``)),
        catchError(this.handleError<Hole[]>(`updateHoles, course id=${courseId}`))
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
