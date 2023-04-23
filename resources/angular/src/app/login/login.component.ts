import { Component, Output, EventEmitter } from '@angular/core';
import {LoginService} from "../login-service";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent {

  constructor(private loginService: LoginService) {}

  showLoginFields: boolean = false;
  email: string = '';
  password: string = '';
  @Output() authenticatedEmitter = new EventEmitter<boolean>();

  showLogin() {
    this.showLoginFields = true;
  }

  login() {
    this.loginService.login(this.email, this.password);
    let authenticatedEmitter;
    if (localStorage.getItem('token') == null) {
      this.showLoginFields = true;
      this.authenticatedEmitter.emit(this.showLoginFields);
    }
  }
}
