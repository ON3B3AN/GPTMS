import { Hole } from './../hole';
import { Component, OnInit } from '@angular/core';
import {Course} from '../course';
import {CourseService} from '../course.service';


@Component({
  selector: 'app-play',
  templateUrl: './play.component.html',
  styleUrls: ['./play.component.sass']
})
export class PlayComponent implements OnInit {
  holes: Hole[];
  courses: Course[];


  courseChange(evt){
    console.log(evt.target.value,this.courses)
    this.courses.filter( element =>{
      if(element.hole == evt.target.value){
        this.holes = element.hole;
      }
    })
  }
  constructor(private courseService: CourseService) { }

  ngOnInit(): void {
    this.courseService.getCourses()
      .subscribe(data => this.courses = data);

  }


}
