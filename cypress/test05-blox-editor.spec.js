describe('Blox Editor', function() 
{
  before(function () 
  {
    cy.visit('/tm/login')
    cy.url().should('include','/tm/login')

    cy.get('input[name="username"]').type('trendschau')
    cy.get('input[name="password"]').type('password')

    cy.get('form').submit()
    cy.url().should('include','/tm/content')
    cy.getCookie('typemill-session').should('exist')

    cy.visit('/tm/content/visual')
    cy.url().should('include','/tm\/content\/visual')
  })

  beforeEach(function () 
  {
    Cypress.Cookies.preserveOnce('typemill-session')
  })

  it('creates new page', function()
  {
    // click on add element
    cy.get('.addNaviItem > a').eq(0).click()

    /* Check dublicates cannot be made */

    /* Check new page can be created */
    cy.get('.addNaviForm').within(($naviform) =>{
        
        /* add Testpage into input */
        cy.get('input')
          .clear()
          .type('Testpage')
          .should('have.value', 'Testpage')

        cy.get('.b-left').click()
    })

    /* get Navilist */
    cy.get('.navi-list')
      .should('contain', 'Testpage')
      .eq(2).find('a').should(($a) => {
          expect($a).to.have.length(5)
          expect($a[4].href).to.include('/welcome\/testpage')
      })
  })

  it('edits default content', function()
  {
    cy.visit('/tm/content/visual/welcome/testpage')
    cy.url().should('include','/tm\/content\/visual\/welcome\/testpage')

    cy.get('#blox').within(($blox) => {

        /* Change Title */
        cy.get('#blox-0').click()
        cy.get("input")
           .clear()
           .type("This is my Testpage")

        cy.get(".edit").click()
        cy.get('#blox-0').should("contain", "This is my Testpage")

        /* Change Text */
        cy.get('#blox-1').click()
        cy.get("textarea")
           .clear()
           .type("This is the new paragraph for the first line with some text.")

        cy.get(".edit").click()
        cy.get('#blox-1').should("contain", "new paragraph")

    })
  })

  it('edits table', function()
  {
    cy.get('#blox').within(($blox) => {
        /* Get Format Bar */
        cy.get('.format-bar').within(($formats) => {

          /* Edit Table */
          cy.get("button").eq(4).click()
          cy.get("table").within(($table) => {

            /* edit table head */
            cy.get("tr").eq(1).within(($row) => {
              cy.get("th").eq(1).click()
                .clear()
                .type("first Headline")
              cy.get("th").eq(2).click()
                .clear()
                .type("Second Headline")
             })

            /* edit first content row */
            cy.get("tr").eq(2).within(($row) => {
              cy.get("td").eq(1).click()
                .clear()
                .type("Some")
              cy.get("td").eq(2).click()
                .clear()
                .type("More")
             })

            /* edit second content row */
            cy.get("tr").eq(3).within(($row) => {
              cy.get("td").eq(1).click()
                .clear()
                .type("Beautiful")
              cy.get("td").eq(2).click()
                .clear()
                .type("Content")
             })

            /* add new column on the right */
            cy.get("tr").eq(0).within(($row) => {
              cy.get("td").eq(2).click()
              cy.get(".actionline").eq(0).click()
            })
          })

          cy.get("table").within(($table) => {

            /* edit second new column head */
            cy.get("tr").eq(1).within(($row) => {
              cy.get("th").eq(3).click()
                .clear()
                .type("New Head")
             })

            /* edit second new column head */
            cy.get("tr").eq(2).within(($row) => {
              cy.get("td").eq(3).click()
                .clear()
                .type("With")
             })

            /* edit second new column head */
            cy.get("tr").eq(3).within(($row) => {
              cy.get("td").eq(3).click()
                .clear()
                .type("new Content")
             })
          })
          
          /* save table */
          cy.get(".edit").click()

        })

        cy.get('#blox-2').should("contain", "Beautiful").click()

        cy.get('.editactive').within(($activeblock) => {
          cy.get('.component').should("contain", "Beautiful")
        })

    })
  })

  it('Deletes new page', function()
  {
    cy.visit('/tm/content/visual/welcome/testpage')
    cy.url().should('include','/tm\/content\/visual\/welcome\/testpage')

    cy.get('.danger').click()

    cy.get('#modalWindow').within(($modal) => {
      cy.get('button').click()
    })

    cy.visit('/tm/content/visual/welcome')
    cy.get('.navi-list')
      .not('contain', 'Testpage')
      .eq(2).find('a').should(($a) => {
          expect($a).to.have.length(4)
      })    
  })
})