import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { AdminComponent } from './admin/admin.component';
import { ManageCoursesComponent } from './manage-courses/manage-courses.component';
import { ManageUsersComponent } from './manage-users/manage-users.component';

import { AuthGuard } from '../auth.guard';

const adminRoutes: Routes = [
  { path: '', component: AdminComponent, canActivate: [AuthGuard], children: [
      { path: 'courses', component: ManageCoursesComponent },
      { path: 'users', component: ManageUsersComponent }
    ]
  }
];

@NgModule({
  imports: [
    RouterModule.forChild(adminRoutes)
  ],
  exports: [
    RouterModule
  ]
})
export class AdminRoutingModule {}
