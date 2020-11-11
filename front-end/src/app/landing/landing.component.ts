import { Component } from '@angular/core';
import { map } from 'rxjs/operators';
import { Breakpoints, BreakpointObserver } from '@angular/cdk/layout';

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.sass']
})

export class LandingComponent {
  /** Based on the screen size, switch from standard to one column per row */
  columns = 2;
  cards = this.breakpointObserver.observe(Breakpoints.Handset).pipe(
    map(({ matches }) => {
      if (matches) {
        this.columns = 1;
        return [
          { title: 'Play game', cols: 1, rows: 1 },
          { title: 'Last course played', cols: 1, rows: 1 },
          { title: 'Card 3', cols: 1, rows: 1 }
        ];
      }

      this.columns = 2;
      return [
        { title: 'Play game', cols: 2, rows: 1 },
        { title: 'Last course played', cols: 1, rows: 1 },
        { title: 'Card 3', cols: 1, rows: 1 }
      ];
    })
  );

  constructor(private breakpointObserver: BreakpointObserver) {}
}
