import { Injectable } from '@angular/core';
import {PaginatedArticles} from "./paginated-articles";
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

  getArticles(): Observable<PaginatedArticles>
  {
    return this.http.get<PaginatedArticles>('http://warehouse.test/api/products', {headers: this.httpHeaders});
  }
}
