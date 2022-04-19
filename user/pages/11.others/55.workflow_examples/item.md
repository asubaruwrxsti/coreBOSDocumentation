---
title: 'Workflow Examples'
---

Workflow Examples
=================

??? I am looking at setting up a workflow to accomplish this: &lt;WRAP
center round box 94%&gt; 1. if a trouble ticket is marked as *confirm
resolution*, wait 3 days and send out an email if there has been no
modification.  
2. If it is not modified in 4 more days send an email alerting that it
will be closed in 24 hours.  
3. Mark the ticket as closed if it does not get modified in 24 more
hours. (and include in description that it was closed due to inactivity)
&lt;/WRAP&gt;

!!! This setup requires two workflows and a combination of conditions
and configurations. It is an advanced workflow setup. Let's detail each
step.

Our **first workflow** will detect the change of the ticket into the
*confirm resolution* status and setup the emails to be sent out. The
**second workflow** will check daily for inactive tickets and close
them.

The **first workflow** looks like this:

<img src="/en/corebos/workflow/ticketwfinformandclose01.png" class="align-center" width="800" />

where we can see that it will be launched against the **Trouble
Tickets** module **every time the record is saved**. The workflow will
look for the ticket entering the "Wait for Response" status and launch
the tasks only when that happens.

It has two email tasks associated which look like this:

<img src="/en/corebos/workflow/ticketwfinformandclose02.png" class="align-center" width="800" />

The important parts here are the 3 day delay in sending and the
additional condition. When an email task is evaluated, in this case when
the ticket enters "Wait for Response" status, it is automatically put in
a queue for it to be sent. Once in the queue it will ALWAYS be sent. In
this case we tell the system to send it 3 days from "now" so we get our
3 day offset BUT when the day comes we may not want to send it anymore
because the ticket has had some changes. In this case we have to add
additional conditions on the email itself to detect this case and abort
the email if it shouldn't be sent. The condition I use is the "more than
hours before" on the modified time and also that the status is still
"Wait for Response". It is possible that just with the last condition we
could have enough.

The 4 day offset email is identical but with the 4 day numbers.

The [scheduled workflow explanation has a nice image
explaining](/en/scheduled_workflows) the "more than" condition.

The **second workflow** is a scheduled workflow that launches once a day
looking for inactive tickets and closing them after sending and email.
That will be two task, and **update field** task to change the status
and an **email task** to send the email. This looks like this:

<img src="/en/corebos/workflow/ticketwfinformandclose03.png" class="align-center" width="800" />

<img src="/en/corebos/workflow/ticketwfinformandclose04.png" class="align-center" width="800" />

??? Me gustaría que cuando quedan 15 días para que llegue la fecha fin
de un proyecto automáticamente envíe un recordatorio a su usuario
propietario (asignado) recordándole que quedan 15 días. Igualmente
cuando queden 10 y cuando queden 5. ¿Cómo podríamos hacer esto en
CoreBos desde los flujos de trabajo?

!!! Según estés utilizando coreBOS o coreBOSCRM tienes dos
posibilidades:

**En coreBOS:**

-   creas flujo de trabajo asociado al proyecto
-   le añades tres tareas, cada una se ejecuta con un retraso de 15, 10
    y 5 días frente a la fecha fin

<img src="/es/adminmanual/15diasantes.png" class="align-center" width="800" />

el inconveniente es que este correo se mandará siempre, o sea, si
cancelas el proyecto antes, recibirás los correos igual. si cambias la
fecha final se generarán 3 correos nuevos para la nueva fecha pero los
tres que tienes ya programados se mandarán igual

**En coreBOSCRM**

haces lo mismo que en coreBOS pero añades condiciones al flujo y marcas
una nueva opción que hemos añadido que se encuentra en las condiciones
del flujo que se llama "*Evaluar condiciones en el momento de la
ejecución*"

<img src="/es/adminmanual/noenviarsiterminado.png" class="align-center" width="800" />

esta nueva opción hace que se evalúen las condiciones de nuevo justo en
el momento de la ejecución. en el caso que te propongo si el proyecto ha
sido cancelado no se enviarán los correos.

Para el caso de que se haya movido la fecha de ejecución no lo he
pensado bien pero si pones una condición del tipo si hoy faltan 15 días
o la fecha de fin ha cambiado debería funcionar. En el caso de la
creación o cambio de fecha se cumple la segunda parte de la condición y
en el caso de que se haya de mandar el correo se cumplirá la primera
parte.

<img src="/es/adminmanual/targetenddatehaschanged.png" class="align-center" width="800" />
