import { Component } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  isAuthorized: boolean = false;

  constructor() {
    this.isAuthorized = localStorage.getItem('token') !== null;
  }

  receiveAuthenticated(event: boolean) {
    this.isAuthorized = event;
  }
}
