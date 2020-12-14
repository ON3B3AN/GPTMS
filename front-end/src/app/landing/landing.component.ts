import { Component } from '@angular/core';
import { map } from 'rxjs/operators';
import { Breakpoints, BreakpointObserver } from '@angular/cdk/layout';
import {UserService} from '../user.service';
import {AuthService} from '../auth.service';
import {User} from '../user';

@Component({
  selector: 'app-landing',
  templateUrl: './landing.component.html',
  styleUrls: ['./landing.component.sass']
})

export class LandingComponent {
  playerHistory: any;
  user: User;

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

  constructor(private breakpointObserver: BreakpointObserver, private userService: UserService,
              private authService: AuthService) {
    this.authService.currentUser.subscribe(u => {
      this.user = u;
    });
  }

  ngOnInit(): void {
    this.userService.getUserHistory(this.user.user_id)
      .subscribe(data => this.playerHistory = (data) ? data[0] : null);
  }
}
