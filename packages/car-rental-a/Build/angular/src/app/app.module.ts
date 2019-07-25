import {BrowserModule} from "@angular/platform-browser";
import {NgModule} from "@angular/core";
import {HttpClientModule} from "@angular/common/http";

import {AppComponent} from "./app.component";
import {CarService} from "./car.service";
import {CarFilterComponent} from "./car-filter.component";
import {CarComponent} from "./car.component";
import {UrlPipe} from "./url.pipe";
import {FormsModule} from "@angular/forms";
import {CarFilterPipe} from "./car-filter.pipe";

@NgModule({
  declarations: [
    AppComponent,
    CarFilterComponent,
    CarComponent,
    CarFilterPipe,
    UrlPipe
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [
    CarService
  ],
  bootstrap: [
    AppComponent
  ]
})
export class AppModule { }
