import { BrowserModule } from '@angular/platform-browser';
import {HttpClientModule} from "@angular/common/http";
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import {MatToolbarModule} from '@angular/material/toolbar';
import { MatTableModule } from '@angular/material/table';
import {MatCardModule} from '@angular/material/card';
import {NgbModule} from '@ng-bootstrap/ng-bootstrap';
import {MatIconModule} from '@angular/material/icon';
import { MatGridListModule } from '@angular/material/grid-list';
import { MatMenuModule } from '@angular/material/menu';
import { MatButtonModule } from '@angular/material/button';
import { LayoutModule } from '@angular/cdk/layout';
import {MatTabsModule} from '@angular/material/tabs'; 

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AdminModule } from './admin/admin.module';
import { LoginComponent } from './login/login.component';
import { SignupComponent } from './signup/signup.component';
import { LandingComponent } from './landing/landing.component';
import { HistoryComponent } from './history/history.component';
import { CourseListComponent } from './course-list/course-list.component';
import { TrackComponent } from './track/track.component';
import { NavbarComponent } from './navbar/navbar.component';
import { PlayComponent } from './play/play.component';
import { ProfileComponent } from './profile/profile.component';
import { CourseDetailComponent } from './course-detail/course-detail.component';

import { ManageCourseComponent } from './manage-course/manage-course.component';
import { GameComponent } from './game/game.component';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';

@NgModule({
  declarations: [
    AppComponent,
    LoginComponent,
    SignupComponent,
    LandingComponent,
    HistoryComponent,
    CourseListComponent,
    TrackComponent,
    NavbarComponent,
    PlayComponent,
    ProfileComponent,

    CourseDetailComponent,
    ManageCourseComponent,
    GameComponent
  ],
  imports: [
    AppRoutingModule,
    AdminModule,
    BrowserModule,
    FormsModule,
    HttpClientModule,
    MatCardModule,
    MatIconModule,
    MatTableModule,
    MatToolbarModule,
    NgbModule,
    ReactiveFormsModule,
    MatGridListModule,
    MatMenuModule,
    MatButtonModule,
    LayoutModule,
    MatTabsModule,
    BrowserAnimationsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
