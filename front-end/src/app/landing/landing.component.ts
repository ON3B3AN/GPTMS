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
  cardLayout = this.breakpointObserver.observe(Breakpoints.Handset).pipe(
    map(({ matches }) => {
      if (matches) {
        return {
          columns: 1,
          play: { title: 'Play game', cols: 1, rows: 1 },
          hist: { title: 'Last course played', cols: 1, rows: 1 },
          card: { title: 'Card 3', cols: 1, rows: 1 }
        };
      }

      return {
        columns: 2,
        play: { title: 'Play game', cols: 1, rows: 1 },
        hist: { title: 'Last course played', cols: 1, rows: 1 },
        card: { title: 'Card 3', cols: 2, rows: 1 }
      };
    })
  );

  constructor(private breakpointObserver: BreakpointObserver) {}
}
