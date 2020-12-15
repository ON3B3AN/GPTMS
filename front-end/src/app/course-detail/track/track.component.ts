import {AfterViewInit, Component, OnInit} from '@angular/core';
import * as L from 'leaflet';
import {Course} from '../../course';
import {CourseService} from '../../course.service';
import {BreakpointObserver, Breakpoints} from '@angular/cdk/layout';
import { map } from 'rxjs/operators';
import {ActivatedRoute} from '@angular/router';

@Component({
  selector: 'app-track',
  templateUrl: './track.component.html',
  styleUrls: ['./track.component.sass']
})
export class TrackComponent implements OnInit, AfterViewInit {
  id: number;
  course: Course;
  private map;
  private courseMap;
  dispMap = true;
  columns = this.breakpointObserver.observe(Breakpoints.Handset).pipe(
    map(({ matches }) => {
      if (matches) {
        return 2;
      }
      return 4;
    })
  );
  cards = [];
  colors = ['grey', 'green', 'orange', 'red'];

  constructor(private courseService: CourseService, private route: ActivatedRoute,
              private breakpointObserver: BreakpointObserver) { }

  ngOnInit(): void {
    this.id = parseInt(this.route.parent.snapshot.paramMap.get('id'));
    this.courseService.getCourse(this.id)
      .subscribe(data => {
        this.course = data;
        this.course.holes.map((item) => {
          if (item.perimeter === null) {
            this.dispMap = false;
          }
        });
        if (this.dispMap) {
          this.initMap();
          const tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
          });
          this.courseMap = new L.FeatureGroup();
          this.map.addLayer(this.courseMap);
          tiles.addTo(this.map);
          let i = 1;
          this.course.holes.forEach(hole => {
            L.geoJSON(JSON.parse(hole.perimeter)).getLayers()[0].setStyle({
              id: hole.hole_number,
              weight: 1,
              fillOpacity: 0.7,
              color: 'grey',
              dashArray: '3'
            }).bindTooltip('Hole ' + hole.hole_number).addTo(this.courseMap);
            i++;
          });
          this.map.fitBounds(this.courseMap.getBounds());
        } else {
          this.course.holes.forEach(hole => {
            const card = {title: hole.hole_number};
            this.cards.push(card);
          });
        }
      });
  }

  ngAfterViewInit(): void { }

  private initMap(): void {
    this.map = L.map('tMap', {
      center: [42.6730347, -83.196061],
      zoom: 15
    });
  }

}
