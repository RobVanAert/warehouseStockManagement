import { Component } from '@angular/core';
import {Article} from "../article";
import {ArticleService} from "../article.service";
import {PaginatedArticles} from "../paginated-articles";

@Component({
  selector: 'app-articles',
  templateUrl: './articles.component.html',
  styleUrls: ['./articles.component.scss']
})
export class ArticlesComponent {
  articles: Article[] = [];
  constructor(private articleService: ArticleService) { }

  ngOnInit() {
    this.articleService.getArticles().subscribe((paginatedArticles: PaginatedArticles) => {
      this.articles = paginatedArticles.data;
    });

    console.log(this.articles)
  }
}
