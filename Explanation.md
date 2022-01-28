## Problem
An administrator wants to see how his website pages link together to improve his website SEO ranking. 

He needs the ability to trigger a crawler that will retrieve the internal links, store them, save the page content as a static HTML file, generate a sitemap, and display the results on the screen, including any error notice.

Also, the crawler needs to run every hour and perform the same actions as when you trigger it manually, overwriting the previous sitemap and HTML file on each run.

## Solution

### Technical spec
The solution I have chosen was to build an application using different libraries available in the PHP ecosystem.

I had chosen this solution over WordPress because I have built only a few themes and plugins in the past and I am not so proficient with it.

Nonetheless, I hope that building something from scratch will better emphasize my current skill set.

By choosing to build an application, I had to decide how to structure everything and what to use.

With the help of tests, the decision on how to structure the whole application and what to use was postponed until I had completed the Crawler.

At first, I used Domain-Driven Design to model the Crawler app, using different Design Patterns where it made sense, having in mind SOLID, DRY, YAGNI, KISS, and the use of fewer libraries as possible. 

External dependencies are used only in `Infrastructure` and those are abstracted away too by using the Adapter pattern.

After that, I decided to restructure everything into Modules with a Microservices approach in mind. 

As such, the Modules `Crawler` and `App` communicate between them using Adapters (Events or REST in a real-world app).

The initial Crawler code moved into the Crawler Module. 

The App Module contains an MCV micro-framework built using different libraries, mostly Symfony components. 

For the frontend, I used Tailwind and Vue.

For the database, I have used MySQL.

I dockerized the application for easy setup and testing.

### Technical decisions

#### Crawler Module
Here is where I focused most of my attention.

The application is using a series of libraries to achieve the requirements.

##### Problem 1: 
Crawl a page at a given URL and return internal links and HTML.    

##### Solution: 
The assessment didn't specify anything about how we should crawl a page, like building something basic or using a library.

As such, at first, I used the `Symfony/Panther` library but I had problems with making it work on `Debian` when I dockerized the app.

So, I switched to `Goutte`, although is not offer the same results. Goutte will not find  URLs generated from JS, but of course, we can change it with any other library that offers this option. We will only need to require it and add an Adapter for it in the `Infrastructure` folder.

I chose Goutte because of time considerations in making such a library work in the Docker container. 

##### Problem 2:   
The sitemap and the crawled pages need to be saved or deleted.   

##### Solution:   
Use `League/FlySystem` for creating a file, saving content to a file, and deleting the file.  

##### Problem 3: 
The sitemap needs to be generated from a template with a variable that needs to be replaced.    

##### Solution: 
Use `twig/twig` as a templating engine to easily render the template.

##### Problem 4:
Log any error notice that might be triggered in the crawling process.

##### Solution:
Use `Monolog` together with a custom written `ErrorHandler` to save errors into the MySQL database.

Other:
Use `tightenco/collect` - for working with arrays. Is redundant in this situation and probably I should have removed it, but I like Laravel collections and how beautiful the code looks, so I left it :)


#### App Module
In this module, I have put less care because, in a real-world microservice architecture, this would be a typical application, like a Laravel application (which I wanted to use initially) that has a standard structure and well-defined ways to do things (like routing, DB calls, etc.)

The path I've chosen here was to use different Symfony components to create a micro-framework.

For authentication, I have used `Auth0` to abstract away the complexity and to speed up the development.

For the frontend, I have used `TailwindCSS` with no JS until this point, placed inside the App Module, although in a real-world application maybe I would have created a separate client and used something like `Nuxt`.

Also, I have used `Symfony/Console` to create a command that can be triggered by the cron job to run the crawling task.

## How to run de application
```ssh
1. git clone
2. cd & run "docker-compose up -d"
3. visit 0.0.0.0:8001
4. To login into the Admin, click on the button from the bottom-right corner and enter:
    - email: demo@example.com  
    - password: demo
```














