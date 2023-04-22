import { Component } from '@angular/core';
import {Article} from "../article";
import {ArticleService} from "../article.service";
import {PaginatedArticles} from "../paginated-articles";
import {Paginator} from "../paginator";

@Component({
  selector: 'app-articles',
  templateUrl: './articles.component.html',
  styleUrls: ['./articles.component.scss']
})
export class ArticlesComponent {
  articles: Article[] = [];
  paginator: Paginator|undefined;
  constructor(private articleService: ArticleService) { }

  ngOnInit() {
    this.articleService.getArticles().subscribe((paginatedArticles: PaginatedArticles) => {
      this.articles = paginatedArticles.data;
      this.paginator = paginatedArticles.meta;
    });
  }

  pageChange(page: number) {
    this.articleService.getArticles(page).subscribe((paginatedArticles: PaginatedArticles) => {
      this.articles = paginatedArticles.data;
    });
  }
}
