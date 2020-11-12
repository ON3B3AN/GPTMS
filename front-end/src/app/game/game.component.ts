import { Component, OnInit } from '@angular/core';
import { Course } from '../course';
import { CourseService } from '../course.service';

@Component({
  selector: 'app-game',
  templateUrl: './game.component.html',
  styleUrls: ['./game.component.sass']
})
export class GameComponent implements OnInit {
  course: Course;

  constructor(private courseService: CourseService) { }


  ngOnInit(): void {
    this.courseService.getCourse(3).subscribe(data => this.course = data);
    this.courseService.getHoles(3).subscribe(data => {this.course.holes = data; console.log(this.course) });
  }

}
