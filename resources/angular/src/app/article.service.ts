import { Injectable } from '@angular/core';
import { Article } from './article';
import {Observable} from "rxjs";
import {HttpClient, HttpHeaders} from "@angular/common/http";


@Injectable({
  providedIn: 'root'
})
export class ArticleService {

  httpHeaders: HttpHeaders = new HttpHeaders();
  constructor(
    private http: HttpClient,
  ) {
    this.httpHeaders.append('Access-Control-Allow-Origin', 'true');
  }

  getArticles(): Observable<Article[]>
  {
    return this.http.get<Article[]>('http://warehouse.test/api/products', {headers: this.httpHeaders});
  }
}
