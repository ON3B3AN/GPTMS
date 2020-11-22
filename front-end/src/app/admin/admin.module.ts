import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { AdminComponent } from './admin/admin.component';
import { AdminRoutingModule } from './admin-routing.module';
import { ManageCoursesComponent } from './manage-courses/manage-courses.component';
import { ManageUsersComponent } from './manage-users/manage-users.component';
import {MatIconModule} from "@angular/material/icon";
import { AddEditCourseComponent } from './manage-courses/add-edit-course/add-edit-course.component';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';

@NgModule({
  imports: [
    CommonModule,
    AdminRoutingModule,
    MatIconModule,
    FormsModule,
    ReactiveFormsModule
  ],
  declarations: [
    AdminComponent,
    ManageCoursesComponent,
    ManageUsersComponent,
    AddEditCourseComponent
  ]
})
export class AdminModule {}
