 <style>
     @keyframes alarm-wiggle {

         /* rest */
         0% {
             transform: rotate(0deg);
         }

         /* tiny fast wiggle burst */
         4% {
             transform: rotate(1.5deg);
         }

         8% {
             transform: rotate(-1.5deg);
         }

         12% {
             transform: rotate(1.2deg);
         }

         16% {
             transform: rotate(-1.2deg);
         }

         20% {
             transform: rotate(1deg);
         }

         24% {
             transform: rotate(-1deg);
         }

         28% {
             transform: rotate(0.6deg);
         }

         32% {
             transform: rotate(-0.6deg);
         }

         36% {
             transform: rotate(0deg);
         }

         /* idle time */
         100% {
             transform: rotate(0deg);
         }
     }

     .alarm-wiggle {
         animation: alarm-wiggle 3s ease-in-out infinite;
         transform-origin: center;
     }
 </style>
