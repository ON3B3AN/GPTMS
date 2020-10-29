import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AdminComponent } from './admin/admin.component';
import { AdminRoutingModule } from './admin-routing.module';
import { ManageCoursesComponent } from './manage-courses/manage-courses.component';
import { ManageUsersComponent } from './manage-users/manage-users.component';
import {MatIconModule} from "@angular/material/icon";

@NgModule({
  imports: [
    CommonModule,
    AdminRoutingModule,
    MatIconModule
  ],
  declarations: [
    AdminComponent,
    ManageCoursesComponent,
    ManageUsersComponent
  ]
})
export class AdminModule {}
