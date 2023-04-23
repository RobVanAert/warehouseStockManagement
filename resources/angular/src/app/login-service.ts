import { Injectable } from '@angular/core';
import {HttpClient, HttpHeaders, HttpParams} from "@angular/common/http";

@Injectable({
  providedIn: 'root'
})
export class LoginService {
  httpHeaders: HttpHeaders = new HttpHeaders();
  constructor(
    private http: HttpClient,
  ) {
    this.httpHeaders.append('Access-Control-Allow-Origin', 'true');
  }

  login(username: string, password: string): void {
    const params = new HttpParams().set('email', username).set('password', password);
      this.http.post('/test/api/login', params, {headers: this.httpHeaders}).subscribe({
          next: (token) => localStorage.setItem('token', token.toString()),
          error: (error) => console.log(error)
      }
    )
  }
}
