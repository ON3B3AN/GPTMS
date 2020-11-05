import { Component, OnInit } from '@angular/core';
import {Course} from "../course";
import {CourseService} from "../course.service";

@Component({
  selector: 'app-play',
  templateUrl: './play.component.html',
  styleUrls: ['./play.component.sass']
})
export class PlayComponent implements OnInit {

  courses: Course[];
  play_tee: string
  constructor(private courseService: CourseService) { }

  ngOnInit(): void {
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);
  }
  courseChange(e){
    this.courses = e.target.data
}
}

