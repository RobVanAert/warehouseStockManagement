import { Injectable } from '@angular/core';
import {PaginatedArticles} from "./paginated-articles";
import {Observable} from "rxjs";
import {HttpClient, HttpHeaders, HttpParams} from "@angular/common/http";


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

  getArticles(page: Number = 1): Observable<PaginatedArticles>
  {
    let params = new HttpParams();
    params = params.append('page', page.toString());
    return this.http.get<PaginatedArticles>('http://warehouse.test/api/products'  , {headers: this.httpHeaders, params: params});
  }
}
